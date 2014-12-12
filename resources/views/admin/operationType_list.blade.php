@extends('layouts.master')

@section('top_header')
  View All Operation Name
@endsection


@section('content')

<!-- main area -->
<div class="main-content">
  <div class="row">
    <div class="panel mb25">
        <div class="panel-heading border">
          The Name all the type of Operation
        </div>
        <div class="panel-body">
        @if(Session::has('success'))
        <div class="alert alert-success">
          {{Session::get('success')}}
        </div>
      @endif
        
        <div class="table-responsive">
        <table class="table table-bordered table-striped mb0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>cost</th>
              <th>Edit</th>
              @if(Auth::user()->super_id == 1)
              <th>Delete</th>
              @endif
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>cost</th>
              <th>Edit</th>
              @if(Auth::user()->super_id == 1)
              <th>Delete</th>
              @endif
            </tr>         
          </tfoot>
          <tbody>
            <?php $i =1 ; ?>
            @foreach ($operationTypes as $operationType)
              <tr>
              <td><?php echo $i; ?></td>
              <td>{{ $operationType->name }}</td>
              <td>{{ $operationType->cost }} Tk.</td>
              

              <td><a data-toggle="modal" data-target="#edit<?php echo $i; ?>" href=""><button type="button" class="btn btn-info">Edit</button></a></td>

              <div class="modal" id="edit<?php echo $i; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Edit Information</h4>
                    </div>
                    <div class="modal-body">
                      <div class="row mb25">
                      <form class="form-horizontal bordered-group" role="form" action="{{ route('operationType.update') }}" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <label class="col-sm-3 control-label">Name</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="name" placeholder="operationType No" value="{{ Request::old('name') ? Request::old('operationTypeNo') : isset($operationType) ? $operationType->name : '' }} " required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Cost</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="cost" value="{{ Request::old('cost') ? Request::old('cost') : isset($operationType) ? $operationType->cost : '' }} ">
              </div>
            </div>

            <div class="modal-footer no-border clear">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Update</button>
              <input type="hidden" name="_token" value="{{ Session::token() }}">
              <input type="hidden" name="operationType_id" value="{{ $operationType->id }}">
            </div>
                  </div>
                </div>
              </div>
               </form>
              

              @if(Auth::user()->super_id == 1)
              <td><a data-toggle="modal" data-target="#delete<?php echo $i; ?>" href=""><button type="button" class="btn btn-danger">Delete</button></a></td>
              @endif
              <div class="modal" id="delete<?php echo $i; ?>" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Delete the name of Information</h4>
                  </div>
                  <div class="modal-body">
                      Are you sure ?
                  </div>
                  <form action="{{ route('operationType.delete') }}" method="">
                  <div class="modal-footer no-border">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                    <input type="hidden" name="operationType_id" value="{{ $operationType->id }}">
                  </div>
                  </form>
                </div>
              </div>
              </div>
            </tr>
            <?php $i++; ?>
            @endforeach
          </tbody>
        </table>
        <section>
        <nav>
          <ul class="pager">
              @if($operationTypes->currentPage() !== 1)
                <li class="previous"><a href="{{ $operationTypes->previousPageUrl() }}"><span aria-hidden="true">&larr;</span> Older</a></li>
              @endif
              @if($operationTypes->currentPage() !== $operationTypes->lastPage() && $operationTypes->hasPages())
                <li class="next"><a href="{{ $operationTypes->nextPageUrl() }}">Newer <span aria-hidden="true">&rarr;</span></a></li>
              @endif
          </ul>
        </nav>
      </section>
      </div>

      </div>
    </div>
  </div>
  <!-- /main area -->
</div>
<!-- /content panel -->
@endsection