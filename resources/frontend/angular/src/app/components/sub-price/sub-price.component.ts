import {Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild} from '@angular/core';
import {Price} from '../../models/priceModel';
import {PriceService} from '../../services/price.service';
import {ToastrService} from 'ngx-toastr';
import {animate, AnimationEvent, style, transition, trigger} from '@angular/animations';
import {ModalService} from '../../services/modal.service';
import {SlideInOutAnimation} from '../../animations/slide-in-animation';

@Component({
  selector: 'app-sub-price',
  templateUrl: './sub-price.component.html',
  styleUrls: ['./sub-price.component.scss'],
  animations: [SlideInOutAnimation]
})
export class SubPriceComponent implements OnInit {
  @Input() price!: Price;
  @Input() index!: number;
  @Input() show: boolean | undefined;
  @Output() addNew = new EventEmitter<Price>();
  @Output() deleteNew = new EventEmitter<Price>();
  @Output() newFlag = new EventEmitter<boolean>();
  @Output() copyPrice = new EventEmitter<Price>();
  @Output() changed = new EventEmitter<boolean>();
  @ViewChild('element') element: ElementRef | undefined;
  isExist = false;
  oldPrice!: Price;
  showChildren = false;
  deleted = false;
  error: {
    name?: string;
    price?: string;
    otherNumeric?: string;
  } = {};
  regexOpen = /<[^>]*>/;
  regexClose = /<\/[^>]*>/;
  description: any;
  showCopyButton = true;
  itemChanged = false;
  saved = false;

  constructor(private priceService: PriceService,
              private toastr: ToastrService,
              private modalService: ModalService) {
  }

  ngOnInit(): void {
    this.oldPrice = JSON.parse(JSON.stringify(this.price));
    this.isExist = true;
    this.description = this.price.description ? this.strip(this.price.description) : '';
    this.showChildren = this.priceService.getIsShowing(this.price.name);
  }

  captureDoneEvent(event: AnimationEvent): void {
    if (this.element === undefined && event.toState === 'void' && event.phaseName === 'done') {
      if (this.deleted) {
        this.delete();
      }
    }
  }

  strip(value: string): string {
    return value.replace(this.regexOpen, '')?.replace(this.regexClose, '');
  }

  onSave(): void {
    this.saved = true;
    if (this.validateFields()) {
      if (this.price.id) {
        this.priceService.save(this.price).subscribe(data => {
          if (data.status === 200) {
            this.saved = false;
            this.toastr.success('Adat mentve!');
            this.changed.emit(false);
            this.oldPrice = JSON.parse(JSON.stringify(this.price));
            this.showCopyButton = true;
          } else {
            this.toastr.error('Nem sikerült a mentés');
          }
        }, error => {
          if (error.error.message === 'Name already exists') {
            this.toastr.error('Nem sikerült a mentés, mert ez a név már szerepel az adatbázisban.');
          }
        });
      } else {
        this.priceService.new(this.price).subscribe(data => {
          if (data.status === 201) {
            this.saved = false;
            this.toastr.success('Adat mentve!');
            this.newFlag.emit(true);
            this.changed.emit(false);
            this.priceService.loadData();
          }
        }, error => {
          if (error.error.message === 'Name already exists') {
            this.toastr.error('Nem sikerült a mentés, mert ez a név már szerepel az adatbázisban.');
          }
        });
      }
    }
  }

  /** this function just starts delete animation */
  onDelete(): void {
    if (this.price.sub_price?.length > 0) {
      if (!confirm(`A ${this.price.name} kategória, és az összes eleme törlődni fog. Biztosan ezt akarod??`)) {
        return;
      }
    }
    this.deleted = true;
    this.isExist = false;
  }

  delete(): void {
    if (this.price.id) {
      this.priceService.delete(this.price).subscribe(data => {
        this.deleteNew.emit(this.price);
        // this.priceService.loadData();
      });
    } else {
      this.deleteNew.emit(this.price);
    }
  }


  /** sends given event one level up in recursion */
  deleteNewUp(price: Price): void {
    this.deleteNew.emit(price);
  }

  /** sends given event one level up in recursion */
  newFlagUp(value: boolean): void {
    this.newFlag.emit(value);
  }

  /** sends given event one level up in recursion */
  copyUp(price: Price): void {
    this.copyPrice.emit(price);
  }

  /** sends given event one level up in recursion */
  addNewUp(price: Price): void {
    this.addNew.emit(price);
  }

  /** sends given event one level up in recursion */
  changedUp(value: boolean): void {
    this.changed.emit(value);
  }

  onCopy(): void {
    this.copyPrice.emit(this.price);
  }

  onAdd(): void {
    this.showChildren = true;
    this.addNew.emit(this.price);
  }

  onCancel(): void {
    this.price = JSON.parse(JSON.stringify(this.oldPrice));
    this.checkChange();
  }

  validateFields(): boolean {
    if (this.saved) {
      if (!this.price.name || this.price.name === '') {
        this.error.name = 'A név mezőt kötelező kitölteni!';
      } else {
        if (this.error.name) {
          delete this.error.name;
        }
      }
      if (this.oldPrice.price !== null && (this.price.price === 0 || this.price.price === null)) {
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
    const id = this.price.id ? this.price.id : -1;
    const text = this.price.description ? this.price.description : '';
    const subscription = this.modalService.open(id, text).subscribe(data => {
      this.price.description = data;
      this.description = this.strip(this.price.description);
      subscription.unsubscribe();
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
    return this.price.name === this.oldPrice.name &&
      this.price.price === this.oldPrice.price &&
      this.price.current === this.oldPrice.current &&
      this.price.people === this.oldPrice.people &&
      this.price.unit === this.oldPrice.unit &&
      this.price.description === this.oldPrice.description;
  }

  onShow(): void {
    if (this.showChildren) {
      this.showChildren = false;
      this.priceService.removeFromOpen(this.price.name);
      return;
    }
    this.showChildren = true;
    this.priceService.addToOpen(this.price.name);
  }
}
