export class Price {
  id?: number;
  created_at?: any;
  updated_at?: any;
  name = '';
  price?: number;
  current?: number;
  people?: number;
  unit?: string;
  parent_id?: number;
  description?: string;
  sub_price: Price[] = [];
  value?: number;
  selected?: boolean;
  badge?: number;

  constructor(object: any) {
    Object.assign(this, object);
  }
}
