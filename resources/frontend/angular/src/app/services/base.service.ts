import {Inject, Injectable} from '@angular/core';
import {Price} from '../models/priceModel';
import {Observable, ReplaySubject, Subject} from 'rxjs';
import {HttpClient} from '@angular/common/http';
import {Sample} from '../models/sampleModel';

@Injectable({
  providedIn: 'root'
})


export abstract class BaseService<T extends (Price | Sample)> {
  data: Array<T> = [];
  reminder = new ReplaySubject(1);
  open: Array<string> = [];
  sum = new Subject();
  url: string;
  setSelectedRows;

  protected constructor(private http: HttpClient, @Inject(String) subName: string, @Inject(String) url: string) {
    this.url = url;
    this.setSelectedRows = this.makeSelectedRowsFn(subName);
    this.loadData();
  }

  getData(): Array<T> {
    return this.data;
  }

  loadData(): void {
    this.http.get<Array<T>>(this.url).subscribe(data => {
      this.data = data;
      this.reminder.next(true);
    });
  }

  new(itemToSave: T): Observable<any> {
    return this.http.post(this.url, itemToSave, {observe: 'response'});
  }

  save(itemToSave: T): Observable<any> {
    return this.http.put(`${this.url}/${itemToSave.id}`, itemToSave, {observe: 'response'});
  }

  delete(itemToDelete: T): Observable<any> {
    return this.http.delete(`${this.url}/${itemToDelete.id}`, {observe: 'response'});
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

  getSelectedRows(): Array<T> {
    return this.setSelectedRows(this.data);
  }

  // tslint:disable-next-line:typedef
  private makeSelectedRowsFn(key: string) {
    return (items: Array<T>) => {
      return items.reduce((acc: Array<T>, curr: T) => {
        let subResult: Array<T>;
        if (curr[key].length) {
          subResult = this.setSelectedRows(curr[key]);
          if (subResult.length) {
            acc.push(curr);
            subResult.map((item: T) => {
              acc.push(item);
            });
          }
        }
        if (curr.selected) {
          acc.push(curr);
        }
        return acc;
      }, []);
    };
  }
}
