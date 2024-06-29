import { NgModule } from '@angular/core';
import { BrowserModule, provideClientHydration } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { ListaUsuarioComponent } from './componentes/lista-usuario/lista-usuario.component';
import { DetallesUsuarioComponent } from './componentes/detalles-usuario/detalles-usuario.component';
import { EditarUsuarioComponent } from './componentes/editar-usuario/editar-usuario.component';
import { CrearUsuarioComponent } from './componentes/crear-usuario/crear-usuario.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule, provideHttpClient, withFetch } from '@angular/common/http';
import { BvarComponent } from './componentes/bvar/bvar.component';
import { InicioComponent } from './componentes/inicio/inicio.component';


@NgModule({
  declarations: [
    AppComponent,
    ListaUsuarioComponent,
    DetallesUsuarioComponent,
    EditarUsuarioComponent,
    CrearUsuarioComponent,
    BvarComponent,
    InicioComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule,
    ReactiveFormsModule
  ],
  providers: [
    provideClientHydration(),
    provideHttpClient(withFetch())
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
