import {animate, style, transition, trigger} from '@angular/animations';

export const SlideAnimation = [
  trigger('slide', [
    transition(':enter', [
      style({opacity: 0, 'max-height': 0}),
      animate('0.3s ease-in-out', style({opacity: 1, 'max-height': '100px'}))
    ]),
    transition(':leave', [
      style({opacity: 1}),
      animate('0.3s ease-in-out', style({opacity: 0, height: '0px'}))
    ]),
  ]),
];
