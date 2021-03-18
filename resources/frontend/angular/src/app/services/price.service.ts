import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {forkJoin, Observable, ReplaySubject, Subject} from 'rxjs';
import {tap} from 'rxjs/operators';
import { environment } from 'src/environments/environment';
import { Price } from '../models/priceModel';

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

  private getPrice(priceArray): number {
    return priceArray.reduce((acc: number, curr: any) => {
      let currPrice = 0;
      if (curr.sub_price.length) {
        currPrice = this.getPrice(curr.sub_price);
      }
      if (curr.selected) {
        if (curr.unit) {
          const value = curr.value ? curr.value : 0;
          currPrice = value * curr.price;
        } else {
          currPrice = curr.price;
        }
      }
      return acc + currPrice;
    }, 0);
  }

  countSum(): void {
    this.sum.next(this.getPrice(this.data));
  }
}
