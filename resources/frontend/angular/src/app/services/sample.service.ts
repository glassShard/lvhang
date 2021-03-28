import { Injectable } from '@angular/core';
import {Observable, ReplaySubject, Subject} from 'rxjs';
import {HttpClient} from '@angular/common/http';
import {environment} from '../../environments/environment';
import {Sample} from '../models/sampleModel';
import {StreamSample} from '../models/otherModels';
import {BaseService} from './base.service';

@Injectable({
  providedIn: 'root'
})
export class SampleService extends BaseService<Sample>{
  // deleteNew = new Subject<Sample>();
  newFlag = new Subject<boolean>();
  // copy = new Subject<Sample>();
  subSampleListener = new Subject<StreamSample>();
  changed = new Subject<boolean>();


  constructor(http: HttpClient) {
    super(http, 'sub_samples', environment.samplesUrl);
    this.loadData();
  }

  countSum(): void {
    this.sum.next(this.getPrice(this.data));
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
}
