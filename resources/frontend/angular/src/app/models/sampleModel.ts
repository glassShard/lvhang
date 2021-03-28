export class Sample {
  id?: number;
  created_at?: any;
  updated_at?: any;
  name = '';
  price?: number;
  parent_id?: number;
  description?: string;
  sub_sample: Sample[] = [];
  value?: number;
  selected?: boolean;
  badge?: number;

  constructor(object: any) {
    Object.assign(this, object);
  }
}
