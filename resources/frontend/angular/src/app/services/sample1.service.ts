import { Injectable } from '@angular/core';
import {Observable, ReplaySubject, Subject} from 'rxjs';
import {HttpClient} from '@angular/common/http';
import {environment} from '../../environments/environment';
import {Sample} from '../models/sampleModel';
import {StreamSample} from '../models/otherModels';

@Injectable({
  providedIn: 'root'
})
export class SampleService {
  data: Array<Sample> = [];
  reminder = new ReplaySubject(1);
  open: Array<string> = [];
  sum = new Subject();


  deleteNew = new Subject<Sample>();
  newFlag = new Subject<boolean>();
  copy = new Subject<Sample>();
  subSampleListener = new Subject<StreamSample>();
  changed = new Subject<boolean>();


  constructor(private http: HttpClient) {
    this.loadData();
  }

  getData(): Array<Sample> {
    return this.data;
  }

  loadData(): void {
    this.http.get<Array<Sample>>(environment.samplesUrl).subscribe(data => {
      this.data = data;
      this.reminder.next(true);
    });
  }

  new(sample: Sample): Observable<any> {
    return this.http.post(environment.samplesUrl, sample, {observe: 'response'});
  }

  save(sample: Sample): Observable<any> {
    return this.http.put(`${environment.samplesUrl}/${sample.id}`, sample, {observe: 'response'});
  }

  delete(sample: Sample): Observable<any> {
    return this.http.delete(`${environment.samplesUrl}/${sample.id}`, {observe: 'response'});
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

  getSelectedRows(): Array<Sample> {
    return this.setSelectedRows(this.data);
  }

  private getPrice(sampleArray): { price: number } {
    return sampleArray.reduce((acc: { price: number }, curr: any) => {
      let currResult = {price: 0};
      if (curr.sub_sample.length) {
        currResult = this.getPrice(curr.sub_sample);
      }
      if (curr.selected) {
        currResult.price = curr.price;
      }

      return {price: acc.price + currResult.price};
    }, {price: 0});
  }

  private setSelectedRows(samples: Array<Sample>): Array<Sample> {
    return samples.reduce((acc: Array<Sample>, curr: Sample) => {
      let subSampleResult: Array<Sample>;
      if (curr.sub_sample.length) {
        subSampleResult = this.setSelectedRows(curr.sub_sample);
        if (subSampleResult.length) {
          acc.push(curr);
          subSampleResult.map((sample: Sample) => {
            acc.push(sample);
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
