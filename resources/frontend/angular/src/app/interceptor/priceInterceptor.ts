import {Injectable} from '@angular/core';
import {HttpEvent, HttpHandler, HttpInterceptor, HttpRequest} from '@angular/common/http';
import {Observable} from 'rxjs';

@Injectable()
export class PriceInterceptor implements HttpInterceptor {
  intercept(httpRequest: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    const token = localStorage.getItem('token');

    const cloned = httpRequest.clone({
      headers: httpRequest.headers
        .append('Authorization', 'Bearer ' + token)
        .append('Accept', 'application/json')
    });
    return next.handle(cloned);
  }
}
