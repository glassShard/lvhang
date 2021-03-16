import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { PriceListComponent } from './components/price-list/price-list.component';
import {PriceComponent} from './components/price/price.component';

const routes: Routes = [
  { path: 'price/edit', component: PriceListComponent},
  { path: 'price/view', component: PriceComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
