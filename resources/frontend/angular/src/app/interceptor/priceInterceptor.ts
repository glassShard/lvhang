import {Injectable} from '@angular/core';
import {HttpEvent, HttpHandler, HttpInterceptor, HttpRequest} from '@angular/common/http';
import {Observable} from 'rxjs';

@Injectable()
export class PriceInterceptor implements HttpInterceptor {
  intercept(httpRequest: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    // const token = localStorage.getItem('token');
    const token = 'SOcuibLeqf5RSGkxZZi6vOtbhX5MUudyrFjFRuhj12LK1al8W2fsgdQ93kmnBc5taya8oX4vvCSCLVPm';

    const cloned = httpRequest.clone({
      headers: httpRequest.headers
        .append('Authorization', 'Bearer ' + token)
        .append('Accept', 'application/json')
    });
    return next.handle(cloned);
  }
}
