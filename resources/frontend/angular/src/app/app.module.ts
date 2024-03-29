import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { PriceListComponent } from './components/prices/price-list/price-list.component';
import { PriceInterceptor } from './interceptor/priceInterceptor';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { SubPriceComponent } from './components/prices/sub-price/sub-price.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { ToastrModule } from 'ngx-toastr';
import { ModalModule } from './modal';
import { QuillModule } from 'ngx-quill';
import { PriceComponent } from './components/prices/price/price.component';
import { PriceViewItemComponent } from './components/prices/price-view/price-view-item.component';
import { PricingComponent } from './components/pricing/pricing.component';
import { FtPipe } from './pipes/ft-pipe';
import { SampleViewComponent } from './components/samples/sample-view/sample-view.component';
import { SubSampleViewComponent } from './components/samples/sub-sample-view/sub-sample-view.component';
import { SampleEditComponent } from './components/samples/sample-edit/sample-edit.component';
import { SubSampleEditComponent } from './components/samples/sub-sample-edit/sub-sample-edit.component';

@NgModule({
  declarations: [
    AppComponent,
    PriceListComponent,
    SubPriceComponent,
    PriceComponent,
    PriceViewItemComponent,
    PricingComponent,
    FtPipe,
    SampleViewComponent,
    SubSampleViewComponent,
    SampleEditComponent,
    SubSampleEditComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
    BrowserAnimationsModule,
    ToastrModule.forRoot(),
    ModalModule,
    QuillModule.forRoot({
      modules: {
        syntax: false,
        toolbar: [
          ['bold', 'italic', 'underline'],
          ['blockquote', 'code-block'],
          [{ list: 'ordered'}, { list: 'bullet' }],
          [{ script: 'sub'}, { script: 'super' }],
          [{ indent: '-1'}, { indent: '+1' }],
          [{ size: ['small', false, 'large'] }],
          [{ header: [1, 2, 3, 4, 5, 6, false] }],
          [{ align: [] }],
          ['clean'],
          ['link']
        ]
      }
    })
  ],
  providers: [
    {
      provide: HTTP_INTERCEPTORS,
      useClass: PriceInterceptor, multi: true
    }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
