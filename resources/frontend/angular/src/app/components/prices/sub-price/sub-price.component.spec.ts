import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SubPriceComponent } from './sub-price.component';

describe('SubPriceComponent', () => {
  let component: SubPriceComponent;
  let fixture: ComponentFixture<SubPriceComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SubPriceComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(SubPriceComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
