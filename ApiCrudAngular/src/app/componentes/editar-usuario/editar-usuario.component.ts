import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { UserService } from '../../usuario.service';
import { User } from '../../usuarios/usuarios.module';

@Component({
  selector: 'app-editar-usuario',
  templateUrl: './editar-usuario.component.html',
  styleUrls: ['./editar-usuario.component.css']
})
export class EditarUsuarioComponent implements OnInit {
  usuarioForm: FormGroup;
  userId: number | null = null;

  constructor(
    private fb: FormBuilder,
    private userService: UserService,
    private route: ActivatedRoute,
    private router: Router
  ) {
    this.usuarioForm = this.fb.group({
      nombre: ['', Validators.required],
      correo: ['', [Validators.required, Validators.email]],
      telefono: ['', Validators.required]
    });
  }
  ngOnInit(): void {
    // Obtener el ID del usuario desde la URL
    const idParam = this.route.snapshot.paramMap.get('id');
    this.userId = idParam ? Number(idParam) : null;

    // Si el ID es válido, cargar los datos del usuario
    if (this.userId !== null) {
      this.userService.getUserById(this.userId).subscribe({
        next: (user: User) => {
          // Parchar el formulario con los datos del usuario
          this.usuarioForm.patchValue({
            nombre: user.nombre,
            correo: user.correo,
            telefono: user.telefono
          });
        },
        error: (error) => {
          console.error('Error al cargar los datos del usuario', error);
        }
      });
    }
  }

  editarUsuario(): void {
    if (this.usuarioForm.invalid) {
      return;
    }

    if (this.userId !== null) {
      this.userService.updateUser(this.userId, this.usuarioForm.value).subscribe({
        next: (response) => {
          console.log('Usuario actualizado con éxito', response);
          this.router.navigate(['/listaUsuario']);
        },
        error: (error) => {
          console.error('Error al actualizar el usuario', error);
        }
      });
    }
  }



  cancelar() {
    this.router.navigate(['/listaUsuario']);
  }
}