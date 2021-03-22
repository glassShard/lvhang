import {animate, style, transition, trigger} from '@angular/animations';

export const FadeInAnimation = [
  trigger('fadeIn', [
    transition(':enter', [
      style({opacity: 0}),
      animate('0.3s ease-in-out', style({opacity: 1}))
    ]),
    transition(':leave', [
      style({opacity: 1}),
      animate('0.3s ease-in-out', style({opacity: 0}))
    ]),
  ]),
];
