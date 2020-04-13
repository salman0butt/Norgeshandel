@extends('layouts.landingSite')

@section('page_content')
    <style type="text/css" id="cv_style">
        a.edit-btn {
            font-size: 15px;
            border: 1px solid;
            padding: 2px 14px;
            font-weight: 400;
        }

        .table-main {
            padding: 25px 20px 72px;
            background-color: rgba(176, 64, 88, 0.07);
            margin-top: 50px;
            border-radius: 4px;
        }

        .row-border {
            border-bottom: 1px solid #ccc;
        }

        tbody th, tbody tr {
            border-top: 1px solid #dfe4e8;
            vertical-align: top;
            font-weight: 400;
        }

        .row.row-border {
            padding-bottom: 30px;
        }
    </style>
    <main class="cv">
        <div class="dme-container">
            <div class="breade-crumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{url('my-business')}}">Min handel</a></li> <!-- ('cv.breadcrumb.sub') -->
                        <li class="breadcrumb-item"><a href="#">list CV</a></li> <!-- ('cv.breadcrumb.main') -->
                    </ol>
                </nav>
            </div>
            @include('common.partials.flash-messages')
            <div class="mt-5 mb-5">
      <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Date</th>
                <th>View</th>
                <th>Request</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Clark</td>
                <td>Kent</td>
                <td>clarkkent@mail.com</td>
                <td>12/04/2019</td>
                <td><a href="#"><i class="fas fa-eye"></i></a></td>
                <td><a href="#"><i class="fas fa-share"></i></a></td>
                <td><a href="#"><i class="fas fa-trash"></i></a></td>
            </tr>
            <tr>
                <td>2</td>
                <td>John</td>
                <td>Carter</td>
                <td>johncarter@mail.com</td>
                <td>12/04/2019</td>
                <td><a href="#"><i class="fas fa-eye"></i></a></td>
                <td><a href="#"><i class="fas fa-share"></i></a></td>
                <td><a href="#"><i class="fas fa-trash"></i></a></td>
                
            </tr>
            <tr>
                <td>3</td>
                <td>Peter</td>
                <td>Parker</td>
                <td>peterparker@mail.com</td>
                <td>12/04/2019</td>
                <td><a href="#"><i class="fas fa-eye"></i></a></td>
                <td><a href="#"><i class="fas fa-share"></i></a></td>
                <td><a href="#"><i class="fas fa-trash"></i></a></td>
            </tr>  
                        <tr>
                <td>4</td>
                <td>Peter</td>
                <td>Parker</td>
                <td>peterparker@mail.com</td>
                <td>12/04/2019</td>
                <td><a href="#"><i class="fas fa-eye"></i></a></td>
                <td><a href="#"><i class="fas fa-share"></i></a></td>
                <td><a href="#"><i class="fas fa-trash"></i></a></td>
            </tr>  
                        <tr>
                <td>5</td>
                <td>Peter</td>
                <td>Parker</td>
                <td>peterparker@mail.com</td>
                <td>12/04/2019</td>
                <td><a href="#"><i class="fas fa-eye"></i></a></td>
                <td><a href="#"><i class="fas fa-share"></i></a></td>
                <td><a href="#"><i class="fas fa-trash"></i></a></td>
            </tr> 
                        <tr>
                <td>6</td>
                <td>Peter</td>
                <td>Parker</td>
                <td>peterparker@mail.com</td>
                <td>12/04/2019</td>
                <td><a href="#"><i class="fas fa-eye"></i></a></td>
                <td><a href="#"><i class="fas fa-share"></i></a></td>
                <td><a href="#"><i class="fas fa-trash"></i></a></td>
            </tr>             
        </tbody>
    </table>

              
            </div>

        </div>
    </main>

@endsection