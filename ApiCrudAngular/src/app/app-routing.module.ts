import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ListaUsuarioComponent } from './componentes/lista-usuario/lista-usuario.component';
import { DetallesUsuarioComponent } from './componentes/detalles-usuario/detalles-usuario.component';
import { CrearUsuarioComponent } from './componentes/crear-usuario/crear-usuario.component';
import { EditarUsuarioComponent } from './componentes/editar-usuario/editar-usuario.component';
import { InicioComponent } from './componentes/inicio/inicio.component';

const routes: Routes = [
  {path: '', redirectTo: '/inicio', pathMatch: 'full'},
  {path: 'inicio', component: InicioComponent},
  {path: 'listaUsuario', component: ListaUsuarioComponent},
  {path: 'usuarioDetalles/:id', component: DetallesUsuarioComponent},
  {path: 'usuarioCrear', component: CrearUsuarioComponent},
  {path:'UsuarioEditar/:id', component: EditarUsuarioComponent},
  {path: '**', redirectTo: '/inicio', pathMatch:'full'}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
