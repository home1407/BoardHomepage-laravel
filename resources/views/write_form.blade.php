@extends('layouts.app')

@section('title')
새 글쓰기 폼
@endsection

@section('cssNscript')
  <link href="/dist/dropzone.css" rel="stylesheet">
  <script src="/dist/dropzone.js"></script>
  <script src="/bower_components/jquery/dist/jquery.js"></script>
  <script src="/bower_components/tui-code-snippet/dist/tui-code-snippet.js"></script>
  <script src="/bower_components/markdown-it/dist/markdown-it.js"></script>
  <script src="/bower_components/to-mark/dist/to-mark.js"></script>
  <script src="/bower_components/codemirror/lib/codemirror.js"></script>
  <script src="/bower_components/highlightjs/highlight.pack.js"></script>
  <script src="/bower_components/squire-rte/build/squire-raw.js"></script>
  <script src="/bower_components/tui-editor/dist/tui-editor-Editor.min.js"></script>
  <link rel="stylesheet" href="/bower_components/codemirror/lib/codemirror.css">
  <link rel="stylesheet" href="/bower_components/highlightjs/styles/github.css">
  <link rel="stylesheet" href="/bower_components/tui-editor/dist/tui-editor.css">
  <link rel="stylesheet" href="/bower_components/tui-editor/dist/tui-editor-contents.css">
@endsection
@section('content')
<div class="container">
  <h2>새 글쓰기 폼</h2>
  <p>아래의 모든 필드를 채워주세요.</p>
  <form id="store" action="{{route('boards.store')}}" method="post">
    @csrf
    <div class="form-group">
      <label for="title">제목:</label>
      <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}"
      required>
      <div>
          @if($errors->has('title'))
            <span class="warning">
             {{$errors->first('title')}}
            </span>
          @endif
      </div>
    </div>
        <label for = "content">내용</label>
        <div class="form-group">
            <label for="content">내용:</label>
            <textarea class="form-control" rows="5" id="content" name="contents"
            required>{{old('content')}}</textarea>
            <div>
                @if($errors->has('content'))
                  <span class="warning">
                   {{$errors->first('content')}}
                  </span>
                @endif  
            </div>        
          </div>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
  </form>
  <form action="{{route('attachments.store')}}"
      class="dropzone"
      id="dropzone" method="post" enctype="multipart/form-data">
          @csrf
  </form>
</div>

<div style="margin:10px 0 50px 0" >
  <button type="button" class="btn btn-primary offset-md-1" onclick="Clicked()">
  글등록
  </button>
  <a class="btn btn-danger offset-md-1" href="{{route('boards.index',['page'=>1])}}">목록보기</a>
</div>
@include('dropzone')

<script>
  function Clicked(){
    var getEditor = document.createElement("input");
    getEditor.id = "editorContents";
    getEditor.name = "contents";
    getEditor.type = "hidden";
    getEditor.value = editor.getHtml();
    var store = document.getElementById("store");
    store.appendChild(getEditor);
    return $('#store').submit();
  } 
  </script>

@endsection

{{--
    --}}