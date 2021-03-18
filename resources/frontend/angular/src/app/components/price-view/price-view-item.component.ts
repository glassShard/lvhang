import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {Price} from '../../models/priceModel';
import {PriceService} from '../../services/price.service';
import {SlideInOutAnimation} from '../../animations/slide-in-animation';
import {SlideAnimation} from '../../animations/slide-animation';

@Component({
  selector: 'app-price-view-item',
  templateUrl: './price-view-item.component.html',
  styleUrls: ['./price-view-item.component.scss'],
  animations: [SlideInOutAnimation, SlideAnimation]
})
export class PriceViewItemComponent implements OnInit {
  @Input() item!: Price;
  @Input() show: boolean | undefined;
  @Output() addToParentBadge = new EventEmitter<number>();
  showChildren: boolean | undefined;
  details = false;
  badge: number | undefined;

  constructor(private priceService: PriceService) { }

  ngOnInit(): void {
  }

  onShow(): void {
    this.showChildren = !this.showChildren;
  }

  onSelect(): void {
    if (this.item.selected) {
      delete this.item.value;
      this.item.selected = false;
      this.addToParentBadge.emit(-1);
    } else {
      this.item.selected = true;
      this.addToParentBadge.emit(1);
    }
    this.priceService.countSum();
    return;
  }

  onDetails(): void {

  }

  badgeAdded(value): void {
    if (this.item.badge) {
      this.item.badge += value;
    } else {
      this.item.badge = value;
    }

    if (this.item.parent_id) {
      this.addToParentBadge.emit(value);
    }
  }

  onKeyup(event): void {
    this.item.value = +event.target.value;
    this.priceService.countSum();
  }
}
