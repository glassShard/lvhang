import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SubSampleEditComponent } from './sub-sample-edit.component';

describe('SubSampleEditComponent', () => {
  let component: SubSampleEditComponent;
  let fixture: ComponentFixture<SubSampleEditComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SubSampleEditComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(SubSampleEditComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
