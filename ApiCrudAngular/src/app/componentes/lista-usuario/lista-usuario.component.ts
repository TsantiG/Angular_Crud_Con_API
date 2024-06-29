import { Component, OnInit } from '@angular/core';
import { UserService } from '../../usuario.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-lista-usuario',
  templateUrl: './lista-usuario.component.html',
  styleUrl: './lista-usuario.component.css'
})
export class ListaUsuarioComponent implements OnInit {
  
  cont: number = 0;
  usuarios: any[]=[];



    
  constructor(private  userService: UserService, router:Router){}

  ngOnInit(): void {
    this.userService.getUsers().subscribe(users => {
        this.usuarios = users;
    });
  }
  deleteUser(id: number) {
    this.userService.deleteUser(id).subscribe(() => {
      this.usuarios = this.usuarios.filter(user => user.id !== id);
    });
  }
}
