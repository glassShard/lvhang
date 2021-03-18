import {Component, OnDestroy, OnInit} from '@angular/core';
import {Price} from '../../models/priceModel';
import {PriceService} from '../../services/price.service';
import {Subscription} from 'rxjs';

@Component({
  selector: 'app-price',
  templateUrl: './price.component.html',
  styleUrls: ['./price.component.scss']
})
export class PriceComponent implements OnInit, OnDestroy {
  subscriptions: Array<Subscription> = [];
  list: Array<Price> | undefined;
  sum: number | undefined;

  constructor(private priceService: PriceService) { }

  ngOnInit(): void {
    this.subscriptions.push(this.priceService.reminder.subscribe(value => {
      if (value) {
        this.list = this.priceService.getData() as Array<Price>;
      }
    }));
    this.subscriptions.push(this.priceService.sum.subscribe((value: any) => {
      this.sum = value;
    }));
  }

  ngOnDestroy(): void {
    this.subscriptions.forEach((subscription: Subscription) => subscription.unsubscribe());
  }
}
