import {Price} from './priceModel';
import {Sample} from './sampleModel';

export type StreamPrice = {
  method: string;
  value: Price;
};

export type StreamSample = {
  method: string;
  value: Sample;
};
