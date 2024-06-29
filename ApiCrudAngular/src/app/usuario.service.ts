import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { User } from './usuarios/usuarios.module';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  apiUrl = 'http://localhost/directorio/rooters/rooters.php';

  constructor(private http: HttpClient) { }

  // Obtener todos los usuarios
  getUsers(): Observable<User[]> {
    return this.http.get<User[]>(this.apiUrl);
  }

  // Obtener un usuario por ID
  getUserById(id: number): Observable<User> {
    return this.http.get<User>(`${this.apiUrl}/${id}`);
  }

  // Crear un nuevo usuario
  createUser(user: User): Observable<any> {
    return this.http.post<any>(this.apiUrl, user);
  }

  // Actualizar un usuario existente
  updateUser(id: number, user: User): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${id}`, user);
  }

  // Eliminar un usuario por ID
  deleteUser(id: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/${id}`);
  }
}
