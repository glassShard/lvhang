import {Injectable} from '@angular/core';
import {HttpErrorResponse, HttpEvent, HttpHandler, HttpInterceptor, HttpRequest} from '@angular/common/http';
import {Observable} from 'rxjs';
import {tap} from 'rxjs/operators';
import {Router} from '@angular/router';
import {environment} from '../../environments/environment';

@Injectable()
export class PriceInterceptor implements HttpInterceptor {
  constructor(private router: Router) {}

  intercept(httpRequest: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    const token = localStorage.getItem('token');
    // const token = 'SOcuibLeqf5RSGkxZZi6vOtbhX5MUudyrFjFRuhj12LK1al8W2fsgdQ93kmnBc5taya8oX4vvCSCLVPm';

    const cloned = httpRequest.clone({
      headers: httpRequest.headers
        .append('Authorization', 'Bearer ' + token)
        .append('Accept', 'application/json')
    });

    return next.handle(cloned).pipe( tap(() => {},
      (err: any) => {
        if (err instanceof HttpErrorResponse) {
          if (err.status !== 401) {
            return;
          }
          window.location.href = environment.loginUrl;
        }
      }));
  }
}
