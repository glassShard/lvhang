import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SubSampleViewComponent } from './sub-sample-view.component';

describe('SubSampleViewComponent', () => {
  let component: SubSampleViewComponent;
  let fixture: ComponentFixture<SubSampleViewComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SubSampleViewComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(SubSampleViewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
