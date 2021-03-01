import {Component, OnInit} from '@angular/core';
import {PriceService} from '../price.service';
import {Price} from '../models/priceModel';
import {ToastrService} from 'ngx-toastr';
import {Subscription} from 'rxjs';
import {animate, state, style, transition, trigger} from '@angular/animations';

@Component({
  selector: 'app-price-list',
  templateUrl: './price-list.component.html',
  styleUrls: ['./price-list.component.scss'],
  animations: [
    trigger('fadein', [
      state('off', style({
        opacity: 0
      })),
      state('on', style({
        opacity: 1
      })),
      transition('off => on', [
        animate('0.3s')
      ]),
      transition('on => off', [
        animate('0.3s')
      ]),
    ]),
    trigger('instantiate', [
      state('void', style({
        transform: 'translateY(-100px)',
        opacity: 0
      })),
      state('exist', style({
        transform: 'translateY(0px)',
        opacity: 1
      })),
      transition('void => exist', [
        animate('0.3s')
      ]),
      transition('exist => void', [
        animate('0.3s')
      ]),
    ])
  ]
})
export class PriceListComponent implements OnInit {
  list: Array<Price> = [];
  newExists = false;
  changes: Array<boolean> = [];
  subscriptions: Array<Subscription> = [];

  constructor(private priceService: PriceService,
              private toastr: ToastrService) {
  }

  ngOnInit(): void {
    this.subscriptions.push(this.priceService.reminder.subscribe(value => {
      if (value) {
        this.list = this.priceService.getData() as Array<Price>;
      }
    }));
  }

  deleteNew(price: Price): void {
    const result = this.findElementInTree(price);
    const targetArray = this.selectTargetArray(result);
    targetArray.splice(result[result.length - 1], 1);
    this.newExists = false;
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
      parent_id: price.id
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
      piece: price.piece,
      description: price.description
    });

    console.log(result);
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
}
