@extends('layouts/app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>

<div class="card uper">
    <div class="card-header">
        <h2>Créer une fiche :</h2> 
      </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('fiches.store') }}">
          <div class="form-group">
              @csrf
              <label for="nom">Nom :</label>
              <input type="text" class="form-control" name="nom"/>
          </div>
          <div class="form-group">
              <label for="type">Type :</label>
                <select id="type" name="type">
                <option value="" selected disabled hidden>Choisissez un type</option>
                <option value="Film">Film</option>
                <option value="Série">Série</option>
                <option value="Jeu Vidéo">Jeu Vidéo</option>
                <option value="Anime">Anime</option>
                </select>
          </div>
          <div class="form-group">
            <label for="genre">Genre :</label>
              <select id="genre" name="genre">
              <option value="" selected disabled hidden>Choisissez un genre</option>
              <option value="Drame">Drame</option>
              <option value="Action">Action</option>
              <option value="Aventure">Aventure</option>
              <option value="Catastrophe">Catastrophe</option>
              <option value="Comédie">Comédie</option>
              <option value="Documentaire">Documentaire</option>
              <option value="Fantastique">Fantastique</option>
              <option value="Fantasy">Fantasy</option>
              <option value="Guerre">Guerre</option>
              <option value="Historique">Historique</option>
              <option value="Horreur">Horreur</option>
              <option value="Musical">Musical</option>
              <option value="Policier">Policier</option>
              <option value="Romance">Romance</option>
              <option value="Science-Fiction">Science-Fiction</option>
              <option value="Super-Héros">Super-Héros</option>
              <option value="Survival">Survival</option>
              <option value="Thriller">Thriller</option>
              <option value="Western">Western</option>
              </select>
           </div>
          <div class="form-group">
            <label for="sortie">Sortie :</label>
            <input type="date" class="form-control" name="sortie"/>
        </div>
        <div class="form-group">
            <label for="synopsis">Synopsis :</label>
            <textarea rows="5" columns="5" class="form-control" name="synopsis"></textarea>
        </div>
          <button type="submit" class="btn btn-primary">Ajouter</button>
          <a href="{{route('fiches.index')}}" class="btn btn-danger">Retour</a>
      </form>
        
  </div>
</div>
@endsection