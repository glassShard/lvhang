import {Component, ElementRef, OnChanges, OnDestroy, OnInit, SimpleChanges, ViewChild} from '@angular/core';
import {PriceService} from '../../../services/price.service';
import {Price} from '../../../models/priceModel';
import {ToastrService} from 'ngx-toastr';
import {interval, Subscription} from 'rxjs';
import {animate, state, style, transition, trigger} from '@angular/animations';
import {environment} from '../../../../environments/environment';
import {ModalService} from '../../../services/modal.service';

@Component({
  selector: 'app-price-list',
  templateUrl: './price-list.component.html',
  styleUrls: ['./price-list.component.scss']
})
export class PriceListComponent implements OnInit, OnDestroy {
  list: Array<Price> = [];
  newExists = false;
  changes: Array<boolean> = [];
  subscriptions: Array<Subscription> = [];
  id: number | undefined;
  text: string | undefined;
  editorValue: string | undefined;
  editor: any;

  constructor(private priceService: PriceService,
              private toastr: ToastrService,
              private modalService: ModalService) {
  }

  ngOnInit(): void {
    this.subscriptions.push(this.priceService.reminder.subscribe(value => {
      if (value) {
        this.list = this.priceService.getData() as Array<Price>;
        this.newExists = false;
        this.changes = [];
        console.log(this.list);
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

  deleteNew(price: Price): void {
    const result = this.findElementInTree(price);
    const targetArray = this.selectTargetArray(result);
    targetArray.splice(result[result.length - 1], 1);
    if (!price.id) {
      this.newExists = false;
    }
  }

  newToRoot(): void {
    if (this.checkIfNewOrChangedExists()) {
      return;
    }

    const newPrice = new Price({});
    this.list.splice(0, 0, newPrice);
  }

  addNew(price: Price): void {
    if (this.checkIfNewOrChangedExists()) {
      return;
    }

    const newPrice = new Price({
      parent_id: price.id,
      name: '',
      price: null,
      current: null,
      people: null,
      description: '',
      unit: ''
    });
    const result = this.findElementInTree(price);
    const targetArray = this.selectTargetArray(result);
    const i = targetArray.indexOf(price);
    targetArray[i].sub_price.splice(0, 0, newPrice);
  }

  checkIfNewOrChangedExists(): boolean {
    if (this.newExists || this.changes.length) {
      this.toastr.error('El kell mentened a változtatásokat, mielőtt új tételt hozol létre!');
      return true;
    }
    this.newExists = true;

    return false;
  }

  copy(price: Price): void {
    if (this.checkIfNewOrChangedExists()) {
      return;
    }
    const result = this.findElementInTree(price);

    const newItem = new Price({
      name: price.name,
      price: price.price,
      current: price.current,
      people: price.people,
      parent_id: price.parent_id,
      description: price.description
    });

    const targetArray = this.selectTargetArray(result);
    targetArray.splice(result[result.length - 1] + 1, 0, newItem);
  }

  findElementInTree(price: Price): Array<number> {
    const result: Array<number> = [];

    const selectFun = (searchedItem: Price, list: Array<Price>): boolean => {
      const resArray = list.map((arrItem, index) => {
        if (searchedItem === arrItem) {
          result.push(index);
          return true;
        } else {
          if (arrItem.sub_price?.length) {
            if (selectFun(searchedItem, arrItem.sub_price)) {
              result.push(index);
              return true;
            }
          }
          return false;
        }
      });
      return resArray.includes(true);
    };

    selectFun(price, this.list);

    return result.reverse();
  }

  selectTargetArray(result: Array<number>): Array<Price> {
    let targetArray = this.list;
    for (let i = 0; i < result.length - 1; i++) {
      if (targetArray[result[i]]?.sub_price?.length) {
        targetArray = targetArray[result[i]].sub_price;
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
