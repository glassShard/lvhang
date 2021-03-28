import {Component, Input, OnInit, Output, ViewChild, EventEmitter, ElementRef} from '@angular/core';
import { Sample } from '../../../models/sampleModel';
import { SampleService } from '../../../services/sample.service';
import { ToastrService } from 'ngx-toastr';
import { ModalService } from '../../../services/modal.service';
import { take } from 'rxjs/operators';
import { SlideInOutAnimation } from '../../../animations/slide-in-animation';
import { AnimationEvent } from '@angular/animations';
import {removeHtmlTags} from '../../../methods/removeHtmlTags';

@Component({
  selector: 'app-sub-sample-edit',
  templateUrl: './sub-sample-edit.component.html',
  styleUrls: ['./sub-sample-edit.component.scss'],
  animations: [SlideInOutAnimation]
})
export class SubSampleEditComponent implements OnInit {
  @Input() sample!: Sample;
  @Input() index!: number;
  @Input() show: boolean | undefined;
  @Output() newFlag = new EventEmitter<boolean>();
  @Output() changed = new EventEmitter<boolean>();
  @ViewChild('element') element: ElementRef | undefined;
  isExist = false;
  oldSample!: Sample;
  showChildren = false;
  deleted = false;
  error: {
    name?: string;
    price?: string;
    otherNumeric?: string;
  } = {};

  description: any;
  showCopyButton = true;
  itemChanged = false;
  saved = false;

  constructor(private sampleService: SampleService,
              private toastr: ToastrService,
              private modalService: ModalService) {
  }

  ngOnInit(): void {
    this.oldSample = JSON.parse(JSON.stringify(this.sample));
    this.isExist = true;
    this.description = this.sample.description ? removeHtmlTags(this.sample.description) : '';
    this.showChildren = this.sampleService.getIsShowing(this.sample.name);
    console.log(this.oldSample);
  }

  captureDoneEvent(event: AnimationEvent): void {
    if (this.element === undefined && event.toState === 'void' && event.phaseName === 'done') {
      if (this.deleted) {
        this.delete();
      }
    }
  }

  onSave(): void {
    this.saved = true;
    if (this.validateFields()) {
      if (this.sample.id) {
        this.sampleService.save(this.sample).subscribe(data => {
          if (data.status === 200) {
            this.saved = false;
            this.toastr.success('Adat mentve!');
            this.changed.emit(false);
            this.oldSample = JSON.parse(JSON.stringify(this.sample));
            this.showCopyButton = true;
          }
        }, error => this.handleError(error));
      } else {
        this.sampleService.new(this.sample).subscribe(data => {
          if (data.status === 201) {
            this.saved = false;
            this.toastr.success('Adat mentve!');
            this.newFlag.emit(true);
            this.changed.emit(false);
            this.sampleService.loadData();
          }
        }, error => this.handleError(error));
      }
    }
  }

  handleError(error): void {
    if (error.error.message === 'Name already exists') {
      this.toastr.error('Nem sikerült a mentés, mert ez a név már szerepel az adatbázisban.');
    }
    if (error.error.message === 'The given data was invalid.') {
      this.toastr.error('Nem sikerült a mentés, vélhetően azért mert nem adtál meg árat, amikor viszont kitöltötted az áram, az' +
        ' ember, vagy a mértékegység mezőt');
    }
  }

  /** this function just starts delete animation */
  onDelete(): void {
    if (this.sample.sub_sample?.length > 0) {
      if (!confirm(`A ${this.sample.name} kategória, és az összes eleme törlődni fog. Biztosan ezt akarod??`)) {
        return;
      }
    }
    this.deleted = true;
    this.isExist = false;
  }

  delete(): void {
    if (this.sample.id) {
      this.sampleService.delete(this.sample).subscribe(data => {
        this.sampleService.subSampleListener.next({method: 'deleteNew', value: this.sample});
      });
    } else {
      this.sampleService.subSampleListener.next({method: 'deleteNew', value: this.sample});
    }
  }

  /** sends given event one level up in recursion */
  newFlagUp(value: boolean): void {
    this.newFlag.emit(value);
  }

  /** sends given event one level up in recursion */
  changedUp(value: boolean): void {
    this.changed.emit(value);
  }

  onCopy(): void {
    this.sampleService.subSampleListener.next({method: 'copy', value: this.sample});
  }

  onAdd(): void {
    this.showChildren = true;
    this.sampleService.subSampleListener.next({method: 'addNew', value: this.sample});
  }

  onCancel(): void {
    this.sample = JSON.parse(JSON.stringify(this.oldSample));
    this.checkChange();
  }

  validateFields(): boolean {
    if (this.saved) {
      if (!this.sample.name || this.sample.name === '') {
        this.error.name = 'A név mezőt kötelező kitölteni!';
      } else {
        if (this.error.name) {
          delete this.error.name;
        }
      }
      if (this.oldSample.price !== null && (this.sample.price === 0 || this.sample.price === null)) {
        this.error.price = 'Az ár mezőt kötelező kitölteni!';
      } else {
        if (this.error.price) {
          delete this.error.price;
        }
      }

      Object.values(this.error).forEach(value => {
        this.toastr.error(value);
      });

      return !Object.values(this.error).length;
    }
    return false;
  }

  onFocus(): void {
    const id = this.sample.id ? this.sample.id : -1;
    const text = this.sample.description ? this.sample.description : '';
    this.modalService.quillNotifyer.next({open: true, id, text});
    this.modalService.modalReadyNotifyer.pipe(take(1)).subscribe(value => {
      if (value === this.sample.id || (this.sample.id === undefined && value === -1)) {
        this.modalService.open(id);
        this.modalService.quillResult.pipe(take(1)).subscribe(data => {
          this.sample.description = data;
          this.checkChange();
          this.description = this.sample.description ? removeHtmlTags(this.sample.description) : '';
        });
      }
    });
  }

  checkChange(): void {
    this.validateFields();
    if (!this.checkEq()) {
      if (!this.itemChanged) {
        this.changed.emit(true);
        this.itemChanged = true;
        this.showCopyButton = false;
      }
      return;
    }
    this.changed.emit(false);
    this.showCopyButton = true;
  }

  checkEq(): boolean {
    return this.sample.name === this.oldSample.name &&
      this.sample.price === this.oldSample.price &&
      this.sample.description === this.oldSample.description;
  }

  onShow(): void {
    if (this.showChildren) {
      this.showChildren = false;
      this.sampleService.removeFromOpen(this.sample.name);
      return;
    }
    this.showChildren = true;
    this.sampleService.addToOpen(this.sample.name);
  }
}


