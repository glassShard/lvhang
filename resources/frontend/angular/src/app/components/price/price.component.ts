import {Component, ElementRef, OnDestroy, OnInit, ViewChild} from '@angular/core';
import {Price} from '../../models/priceModel';
import {PriceService} from '../../services/price.service';
import {Subscription} from 'rxjs';
import {SlideInOutAnimation} from '../../animations/slide-in-animation';
import {SlideAnimation} from '../../animations/slide-animation';
import {HttpClient} from '@angular/common/http';
import {environment} from '../../../environments/environment';
import {ModalService} from '../../services/modal.service';

@Component({
  selector: 'app-price',
  templateUrl: './price.component.html',
  styleUrls: ['./price.component.scss'],
  animations: [SlideAnimation]
})
export class PriceComponent implements OnInit, OnDestroy {
  subscriptions: Array<Subscription> = [];
  list: Array<Price> | undefined;
  sum: {price: number, current: number, people: number} | undefined;
  showInfo = false;
  error: string | undefined;
  email: string | undefined;
  sent = false;
  top = false;
  sendMessage = {error: '', success: ''};
  @ViewChild('message') message: ElementRef<HTMLTextAreaElement> | undefined;

  constructor(private priceService: PriceService,
              private http: HttpClient,
              private modalService: ModalService) { }

  ngOnInit(): void {
    this.subscriptions.push(this.priceService.reminder.subscribe(value => {
      if (value) {
        this.list = this.priceService.getData() as Array<Price>;
      }
    }));
    this.subscriptions.push(this.priceService.sum.subscribe((value: any) => {

      /** watts devided by 230volts to convert to ampers */

      this.sum = {price: value.price, current: Math.ceil(value.current / 230), people: value.people};
    }));
  }

  onSendMail(): void {
    this.sendMessage.error = '';
    this.sent = true;
    if (this.testEmail()) {
      const rows = this.priceService.getSelectedRows();
      const data = {
        email: this.email,
        message: this.message?.nativeElement.value,
        priceRows: rows,
        sumPeople: this.sum?.people,
        sumCurrent: this.sum?.current,
        sumPrice: this.sum?.price
      };
      this.http.post(environment.mailUrl, JSON.stringify(data)).subscribe((response) => {
        if (response === 'Success') {
          this.sendMessage.success = 'Az üzenetet megkaptuk, rövidesen válaszolunk.';
          setTimeout(() => {
            this.sendMessage.success = '';
          }, 3000);
        } else {
          this.sendMessage.error = 'Hiba történt az üzenetküldés során';
        }
        this.sent = false;
      });
    }
  }

  testEmail(): boolean {
    const regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (this.email && regex.test(this.email)) {
      return true;
    }
    this.error = 'Ha ide nem megfelelő email címet ír, nem tudjuk eljuttatni az árajánlatot';
    return false;
  }

  onTypeEmail(): void {
    if (this.sent) {
      if (this.testEmail()) {
        delete this.error;
      }
    }
  }

  ngOnDestroy(): void {
    this.subscriptions.forEach((subscription: Subscription) => subscription.unsubscribe());
  }

  onShowPricingFromTop(): void {
    this.top = !this.top;
  }

  onShowInfo(): void {
    if (this.showInfo) {
      this.top = false;
    }
    this.showInfo = !this.showInfo;
  }
}
