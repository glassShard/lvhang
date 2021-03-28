import {Component, NgModule} from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { PriceListComponent } from './components/prices/price-list/price-list.component';
import {PriceComponent} from './components/prices/price/price.component';
import {SampleEditComponent} from './components/samples/sample-edit/sample-edit.component';
import {SampleViewComponent} from './components/samples/sample-view/sample-view.component';

const routes: Routes = [
  { path: 'price/edit', component: PriceListComponent},
  { path: 'price/view', component: PriceComponent},
  { path: 'sample/edit', component: SampleEditComponent},
  { path: 'sample/view', component: SampleViewComponent},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
