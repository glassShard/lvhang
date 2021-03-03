import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { PriceListComponent } from './components/price-list/price-list.component';

const routes: Routes = [
  { path: 'price/edit', component: PriceListComponent},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
