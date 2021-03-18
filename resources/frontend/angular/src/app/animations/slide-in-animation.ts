import {animate, style, transition, trigger} from '@angular/animations';

export const SlideInOutAnimation = [
  trigger('instantiate', [
    transition(':enter', [
      style({transform: 'translateY(-100px)', opacity: 0, 'max-height': 0}),
      animate('0.3s ease-in-out', style({opacity: 1, transform: 'translateY(0px)', 'max-height': '2000px'}))
    ]),
    transition(':leave', [
      style({transform: 'translateY(0px)', opacity: 1}),
      animate('0.3s ease-in-out', style({opacity: 0, transform: 'translateY(-100px)', height: '0px'}))
    ]),
  ]),
];
