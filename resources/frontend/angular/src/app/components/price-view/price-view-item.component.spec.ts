import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PriceViewItemComponent } from './price-view-item.component';

describe('PriceViewItemComponent', () => {
  let component: PriceViewItemComponent;
  let fixture: ComponentFixture<PriceViewItemComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PriceViewItemComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(PriceViewItemComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
