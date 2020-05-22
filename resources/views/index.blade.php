@extends('layouts/app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>

<script>
function search() {
  var input, filter, table, tr, td1, td2, td3, i, txtValue1, textValue2, textValue3;
  input = document.getElementById("indexInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("indexTable");
  tr = table.getElementsByTagName("tr");

  for (i = 1; i < tr.length; i++) {
    td1 = tr[i].getElementsByTagName("td")[0]; /*Nom*/
    td2 = tr[i].getElementsByTagName("td")[1]; /*Type*/
    td3 = tr[i].getElementsByTagName("td")[2]; /*Genre*/
    td3 = tr[i].getElementsByTagName("td")[6]; /*Auteur*/

    if (td1)  {
      txtValue1 = td1.textContent || td1.innerText;
    }

    if (td2) {
      txtValue2 = td2.textContent || td2.innerText;
    }

    if (td3) {
      txtValue3 = td3.textContent || td3.innerText;
    }

    if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 || txtValue3.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
  }
}
</script>

<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif

  <div class="card-list-header" style="padding-bottom:10px;padding-top:10px"> 
    <div class="text-home">
      @if(auth()->user()->isAdmin == 0)
        <h3>Bonjour {{auth()->user()->name}} ! Vous êtes connecté en temps que membre, vous pouvez donc uniquement consulter la liste des fiches !</h3><br>
      @endif
      @if(auth()->user()->isAdmin == 1)
        <h3>Bonjour {{auth()->user()->name}} ! Vous êtes connecté en temps qu'administrateur, vous avez donc accès à la liste des fiches, ainsi qu'aux différentes fonctionnalités de gestion !</h3><br>
      @endif
    </div>
    @if(auth()->user()->isAdmin == 1)
      <a href="{{ route('fiches.create')}}" class="btn btn-primary">Créer une fiche</a>
    @endif
    <input type="text" id="indexInput" onkeyup="search()" style="width:15em; margin-left:1em" placeholder="Recherche nom, type, genre ...">
  </div>

  <table class="table table-striped" id="indexTable">
    <thead>
        <tr class="header">
          <td>Nom</td>
          <td>Type</td>
          <td>Genre</td>
          <td>Sortie</td>
          <td>Synopsis</td>
          <td>Auteur</td>
          @if(auth()->user()->isAdmin == 1)
            <td colspan="2">Action</td>
          @endif
        </tr>
    </thead>
    <tbody>
        @foreach($fichescases as $fiche)
        <tr >
            <td> {{$fiche->nom}} </td>
            <td> {{$fiche->type}} </td>
            <td> {{$fiche->genre}} </td>
            <td> {{$fiche->sortie}} </td>
            <td> {{$fiche->synopsis}} </td>
            <td> {{$fiche->auteur}} </td>
            @if(auth()->user()->isAdmin == 1)
            <td><a href="{{ route('fiches.edit', $fiche->id)}}" class="btn btn-primary">Modifier</a></td>
            {{--<td><button class="btn btn-danger" data-id={{$fiche->id}} data-toggle="modal" data-target="#delete">Supprimer</button></td> --}}
            <td>
                <form action="{{ route('fiches.destroy', $fiche->id)}}" onclick="return confirm('Voulez-vous vraiment supprimer cette fiche ?');" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Supprimer</button>
                </form>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
  </table>
</div>

{{-- Pour une raison que j'ignore, ce modal servant à la confirmation de suppression ne fonctionne pas. Pour être exact, le modal fonctionne mais n'apparait 
pas au click sur le bouton supprimer (fade). Je laisse le code en commentaire au cas où mais il n'est donc pas fonctionnel. --}}

<!-- Modal -->
{{-- <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
        </div>
        <form action="{{route('fiches.destroy',$fiche->id)}}" method="post">
                @csrf
                @method('DELETE')
            <div class="modal-body">
                  <p class="text-center">
                      Voulez-vous vraiment supprimer cette fiche ?
                  </p>
                      <input type="hidden" name="f_id" id="fiches_id" value="">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
              <button type="submit" class="btn btn-warning">Yes, Delete</button>
            </div>
        </form>
      </div>
    </div>
  </div> --}}
  @endsection