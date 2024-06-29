import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { UserService } from '../../usuario.service';
import {User} from '../../usuarios/usuarios.module';
import { Observer } from 'rxjs';

@Component({
  selector: 'app-crear-usuario',
  templateUrl: './crear-usuario.component.html',
  styleUrls: ['./crear-usuario.component.css']
})
export class CrearUsuarioComponent {
  user: User = { nombre: '', correo: '', telefono: '' };

  constructor(private userService: UserService, private router: Router) { }

  enviarUsuario() {
     // Definir un Observer
     const observer: Observer<any> = {

      next: (response) => {
        console.log('Usuario creado exitosamente', response);
        this.router.navigate(['/listaUsuario']);
      },

      error: (error) => {
        console.error('Error al crear el usuario', error);
        
      },
      complete: () => {
        console.log('Proceso de creación completado.');
      }
    };
    // Usar el Observer en la suscripción
    this.userService.createUser(this.user).subscribe(observer);

  }
}