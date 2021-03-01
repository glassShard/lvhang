import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {forkJoin, Observable, ReplaySubject, Subject} from 'rxjs';
import {tap} from 'rxjs/operators';
import { environment } from 'src/environments/environment';
import { Price } from './models/priceModel';

@Injectable({
  providedIn: 'root'
})
export class PriceService {
  data: Array<Price> = [];
  reminder = new ReplaySubject(1);

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
}
