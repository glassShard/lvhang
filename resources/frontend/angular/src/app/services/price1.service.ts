import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {forkJoin, Observable, ReplaySubject, Subject} from 'rxjs';
import {environment} from 'src/environments/environment';
import {Price} from '../models/priceModel';

@Injectable({
  providedIn: 'root'
})
export class PriceService {
  data: Array<Price> = [];
  reminder = new ReplaySubject(1);
  open: Array<string> = [];
  sum = new Subject();

  constructor(private http: HttpClient) {
    this.loadData();
  }

  getData(): Array<Price> {
    return this.data;
  }

  loadData(): void {
    this.http.get<Array<Price>>(environment.pricesUrl).subscribe(data => {
      this.data = data;
      this.reminder.next(true);
    });
  }

  new(price: Price): Observable<any> {
    return this.http.post(environment.pricesUrl, price, {observe: 'response'});
  }

  save(price: Price): Observable<any> {
    return this.http.put(`${environment.pricesUrl}/${price.id}`, price, {observe: 'response'});
  }

  delete(price: Price): Observable<any> {
    return this.http.delete(`${environment.pricesUrl}/${price.id}`, {observe: 'response'});
  }

  addToOpen(value: string): void {
    this.open.push(value);
  }

  removeFromOpen(value: string): void {
    const ind = this.open.indexOf(value);
    this.open.splice(ind, 1);
  }

  getIsShowing(value: string): boolean {
    const ind = this.open.indexOf(value);
    return ind >= 0;
  }

  countSum(): void {
    this.sum.next(this.getPrice(this.data));
  }

  getSelectedRows(): Array<Price> {
    return this.setSelectedRows(this.data);
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

  private setSelectedRows(prices: Array<Price>): Array<Price> {
    return prices.reduce((acc: Array<Price>, curr: Price) => {
      let subPriceResult: Array<Price>;
      if (curr.sub_price.length) {
        subPriceResult = this.setSelectedRows(curr.sub_price);
        if (subPriceResult.length) {
          acc.push(curr);
          subPriceResult.map((price: Price) => {
            acc.push(price);
          });
        }
      }
      if (curr.selected) {
        acc.push(curr);
      }
      return acc;
    }, []);
  }
}
