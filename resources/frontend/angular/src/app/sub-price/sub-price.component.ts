import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {Price} from '../models/priceModel';
import {PriceService} from '../price.service';
import {ToastrService} from 'ngx-toastr';
import {animate, state, style, transition, trigger} from '@angular/animations';
import {ModalService} from '../modal.service';

@Component({
  selector: 'app-sub-price',
  templateUrl: './sub-price.component.html',
  styleUrls: ['./sub-price.component.scss'],
  animations: [
    trigger('instantiate', [
      // ...
      state('void', style({
        transform: 'translateY(-100px)',
        opacity: 0
      })),
      state('exist', style({
        transform: 'translateY(0px)',
        opacity: 1
      })),
      transition('void => exist', [
        animate('0.3s')
      ]),
      transition('exist => void', [
        animate('0.3s')
      ]),
    ]),
  ]
})
export class SubPriceComponent implements OnInit {
  @Input() price!: Price;
  @Input() index!: number;
  @Output() addNew = new EventEmitter<Price>();
  @Output() deleteNew = new EventEmitter<Price>();
  @Output() newFlag = new EventEmitter<boolean>();
  @Output() copyPrice = new EventEmitter<Price>();
  @Output() changed = new EventEmitter<boolean>();
  isExist = false;
  oldPrice!: Price;
  error: {
    name?: string;
    price?: string;
    otherNumeric?: string;
    description?: string;
  } = {};
  regexOpen = /<[^>]*>/;
  regexClose = /<\/[^>]*>/;
  description: any;
  showCopyButton = true;

  constructor(private priceService: PriceService,
              private toastr: ToastrService,
              private modalService: ModalService) {
  }

  ngOnInit(): void {
    this.oldPrice = JSON.parse(JSON.stringify(this.price));
    this.isExist = true;
    this.description = this.price.description ? this.strip(this.price.description) : '';
    // console.log(this.price);
  }

  strip(value: string): string {
    return value.replace(this.regexOpen, '')?.replace(this.regexClose, '');
  }

  onSave(): void {
    if (this.validateFields()) {
      if (this.price.id) {
        this.priceService.save(this.price).subscribe(data => {
          if (data.status === 200) {
            this.toastr.success('Adat mentve! :)');
            this.changed.emit(false);
            this.oldPrice = JSON.parse(JSON.stringify(this.price));
            this.showCopyButton = true;
          } else {
            this.toastr.error('Nem sikerült a mentés :(');
          }
        });
      } else {
        this.priceService.new(this.price).subscribe(data => {
          if (data.status === 201) {
            this.toastr.success('Adat mentve! :)');
            this.newFlag.emit(true);
            this.priceService.loadData();
          } else {
            this.toastr.error('Nem sikerült a mentés :(');
          }
        });
      }
    }
  }

  onDelete(): void {
    if (this.price.id) {
      this.priceService.delete(this.price).subscribe(data => {
        this.priceService.loadData();
      });
    } else {
      this.deleteNew.emit(this.price);
    }
  }

  /** sends given event one level up in recursion */
  deleteNewUp(price: Price): void {
    this.deleteNew.emit(price);
  }

  /** sends given event one level up in recursion */
  newFlagUp(value: boolean): void {
    this.newFlag.emit(value);
  }

  /** sends given event one level up in recursion */
  copyUp(price: Price): void {
    this.copyPrice.emit(price);
  }

  /** sends given event one level up in recursion */
  addNewUp(price: Price): void {
    this.addNew.emit(price);
  }

  /** sends given event one level up in recursion */
  changedUp(value: boolean): void {
    this.changed.emit(value);
  }

  onCopy(): void {
    this.copyPrice.emit(this.price);
  }

  onAdd(): void {
    console.log(this.price);
    this.addNew.emit(this.price);
  }

  onCancel(): void {
    this.price = JSON.parse(JSON.stringify(this.oldPrice));
    this.checkChange();
  }

  validateFields(): boolean {
    if (!this.price.name || this.price.name === '') {
      this.error.name = 'A név mezőt kötelező kitölteni!';
    }
    if (this.oldPrice.price !== null && (this.price.price === 0 || this.price.price === null)) {
      this.error.price = 'Az ár mezőt kötelező kitölteni!';
    }
    console.log(this.error);

    Object.values(this.error).forEach(value => {
      this.toastr.error(value);
    });

    return !Object.values(this.error).length;
  }

  onFocus(): void {
    const id = this.price.id ? this.price.id : -1;
    const text = this.price.description ? this.price.description : '';
    const subscription = this.modalService.open(id, text).subscribe(data => {
      this.price.description = data;
      this.description = this.strip(this.price.description);
      subscription.unsubscribe();
    });
  }

  checkChange(): void {
    if (!this.checkEq()) {
      this.changed.emit(true);
      this.showCopyButton = false;
      return;
    }
    this.changed.emit(false);
    this.showCopyButton = true;
  }

  checkEq(): boolean {
    return this.price.name === this.oldPrice.name &&
      this.price.price === this.oldPrice.price &&
      this.price.current === this.oldPrice.current &&
      this.price.piece === this.oldPrice.piece &&
      this.price.people === this.oldPrice.people &&
      this.price.description === this.oldPrice.description;
  }
}
