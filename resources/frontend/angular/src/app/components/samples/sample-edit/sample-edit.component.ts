import {Component, OnDestroy, OnInit} from '@angular/core';
import {interval, Subscription} from 'rxjs';
import {ToastrService} from 'ngx-toastr';
import {ModalService} from '../../../services/modal.service';
import {Sample} from '../../../models/sampleModel';
import {SampleService} from '../../../services/sample.service';
import {StreamSample} from '../../../models/otherModels';

@Component({
  selector: 'app-sample-edit',
  templateUrl: './sample-edit.component.html',
  styleUrls: ['./sample-edit.component.scss']
})
export class SampleEditComponent implements OnInit, OnDestroy {
  list: Array<Sample> = [];
  newExists = false;
  changes: Array<boolean> = [];
  subscriptions: Array<Subscription> = [];
  id: number | undefined;
  text: string | undefined;
  editorValue: string | undefined;
  editor: any;

  constructor(private sampleService: SampleService,
              private toastr: ToastrService,
              private modalService: ModalService) {
  }

  ngOnInit(): void {
    this.subscriptions.push(this.sampleService.reminder.subscribe(value => {
      if (value) {
        this.list = this.sampleService.getData() as Array<Sample>;
        this.newExists = false;
        this.changes = [];
        console.log(this.list);
      }
    }));
    this.subscriptions.push(this.sampleService.subSampleListener.subscribe((value: StreamSample) => {
      if (value.method === 'addNew') {
        this.addNew(value.value);
      }
      if (value.method === 'copy') {
        this.copy(value.value);
      }
      if (value.method === 'deleteNew') {
        this.deleteNew(value.value);
      }
    }));
    this.subscriptions.push(this.modalService.quillNotifyer.subscribe((value: any) => {
      if (value.open) {
        this.id = value.id;
        this.text = value.text;
        this.editorValue = this.text;
        const subscription = interval(50).subscribe(() => {
          if (this.editor) {
            subscription.unsubscribe();
            this.editor.focus();
          }
        });
      } else {
        if (value.id === this.id) {
          this.modalService.quillResult.next(this.editorValue);
          delete this.id;
          delete this.text;
          delete this.editor;
        }
      }
    }));
  }

  create(event): void {
    this.editor = event;
  }

  onCloseModal(): void {
    this.editorValue = this.text;
  }

  deleteNew(sample: Sample): void {
    const result = this.findElementInTree(sample);
    const targetArray = this.selectTargetArray(result);
    targetArray.splice(result[result.length - 1], 1);
    if (!sample.id) {
      this.newExists = false;
    }
  }

  newToRoot(): void {
    if (this.checkIfNewOrChangedExists()) {

      return;
    }

    const newSample = new Sample({});
    this.list.splice(0, 0, newSample);
  }

  addNew(sample: Sample): void {
    if (this.checkIfNewOrChangedExists()) {
      return;
    }

    const newSample = new Sample({
      parent_id: sample.id,
      name: '',
      price: null,
      description: ''
    });
    const result = this.findElementInTree(sample);
    const targetArray = this.selectTargetArray(result);
    const i = targetArray.indexOf(sample);
    targetArray[i].sub_sample.splice(0, 0, newSample);
  }

  checkIfNewOrChangedExists(): boolean {
    if (this.newExists || this.changes.length) {
      this.toastr.error('El kell mentened a változtatásokat, mielőtt új tételt hozol létre!');
      return true;
    }
    this.newExists = true;

    return false;
  }

  copy(sample: Sample): void {
    if (this.checkIfNewOrChangedExists()) {
      return;
    }
    const result = this.findElementInTree(sample);

    const newItem = new Sample({
      name: sample.name,
      price: sample.price,
      parent_id: sample.parent_id,
      description: sample.description
    });

    const targetArray = this.selectTargetArray(result);
    targetArray.splice(result[result.length - 1] + 1, 0, newItem);
  }

  findElementInTree(sample: Sample): Array<number> {
    const result: Array<number> = [];

    const selectFun = (searchedItem: Sample, list: Array<Sample>): boolean => {
      const resArray = list.map((arrItem, index) => {
        if (searchedItem === arrItem) {
          result.push(index);
          return true;
        } else {
          if (arrItem.sub_sample?.length) {
            if (selectFun(searchedItem, arrItem.sub_sample)) {
              result.push(index);
              return true;
            }
          }
          return false;
        }
      });
      return resArray.includes(true);
    };

    selectFun(sample, this.list);

    return result.reverse();
  }

  selectTargetArray(result: Array<number>): Array<Sample> {
    let targetArray = this.list;
    for (let i = 0; i < result.length - 1; i++) {
      if (targetArray[result[i]]?.sub_sample?.length) {
        targetArray = targetArray[result[i]].sub_sample;
      }
    }

    return targetArray;
  }

  changed(value: boolean): void {
    if (value) {
      this.changes.push(value);
      return;
    }
    this.changes.pop();
  }

  ngOnDestroy(): void {
    this.subscriptions.forEach((subscription: Subscription) => subscription.unsubscribe());
  }
}
