import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {environment} from 'src/environments/environment';
import {Price} from '../models/priceModel';
import {BaseService} from './base.service';

@Injectable({
  providedIn: 'root'
})
export class PriceService extends BaseService<Price> {

  constructor(http: HttpClient) {
    super(http, 'sub_prices', environment.pricesUrl);
    this.loadData();
  }

  countSum(): void {
    this.sum.next(this.getPrice(this.data));
  }

  private getPrice(priceArray): { price: number, current: number, people: number } {
    return priceArray.reduce((acc: { price: number, current: number, people: number }, curr: any) => {
      let currResult = {price: 0, current: 0, people: 0};
      if (curr.sub_price.length) {
        currResult = this.getPrice(curr.sub_price);
      }
      if (curr.selected) {
        if (curr.unit) {
          const value = curr.value ? curr.value : 0;
          currResult.price = value * curr.price;
          if (curr.current) {
            currResult.current = value * curr.current;
          }
          if (curr.people) {
            currResult.people = value * curr.people;
          }
        } else {
          currResult.price = curr.price;
          if (curr.current) {
            currResult.current = curr.current;
          }
          if (curr.people) {
            currResult.people = curr.people;
          }
        }
      }
      return {
        price: acc.price + currResult.price,
        current: acc.current + currResult.current,
        people: acc.people + currResult.people
      };
    }, {price: 0, current: 0, people: 0});
  }
}
