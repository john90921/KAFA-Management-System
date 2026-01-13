@extends('layouts.master')

@section('content')
            <div class="d-flex justify-content-end m-5">
            <a href="/add_classroom" class="btn btn-primary fw-bold">Add Class</a>
        </div>
    <div class="container mt-3 mb-3">

        @if (session('message'))
            <div class="alert alert-info" id="success-message">
                {{ session('message') }}
            </div>
        @endif

        <div>

            <div>
                <div class="row">
                    <div class="col-md-3 ">
                        <h2 class="fw-bold h-80">Total unassigned students:</h2>
                        <div class="fw-bold"> {{ $dashboardData['unassignedStudents']->count() }} </div>
                    </div>
                    <div class="col-md-3">
                        <h2 class="fw-bold h-80">Total unasigned teachers :</h2>
                        <div class="fw-bold"> {{ $dashboardData['unassignedTeachers']->count() }}</div>
                    </div>
                    <div class="col-md-3">
                        <h2 class="fw-bold">Total students</h2>
                        <div class="fw-bold"> {{ $students->count() }}</div>
                    </div>
                    <div class="col-md-3">
                        <h2 class="fw-bold h-80">Total classes:</h2>
                        <div class="fw-bold"> {{ $classes->count() }}</div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 my-5 d-flex justify-content-center align-items-center flex-column">
                        <div>
                            <h3>
                                Status of students
                            </h3>
                        </div>
                        <div style="position: relative; " x-data="chartComponentStudent(@json($dashboardData['assignedStudents']->count()), @json($dashboardData['unassignedStudents']->count()))"
                            x-init="initChart()">
                            <canvas x-ref="chart" id="myChart"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6 my-5 d-flex justify-content-center align-items-center flex-column">
                        <div>
                            <h3>
                                Status of teachers
                            </h3>
                        </div>
                        <div style="position: relative; " x-data="chartComponentTeacher(@json($dashboardData['assignedTeachers']->count()), @json($dashboardData['unassignedTeachers']->count()))"
                            x-init="initChart()">
                            <canvas x-ref="chart" id="myChart"></canvas>
                        </div>
                    </div>

                </div>

            </div>

            <h1>
               Unassigned Teachers
            </h1>
            <div style="  max-height: 200px;
  overflow-y: auto;
  border: 1px solid #ccc;">
                <table class="table" >
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col"> Name</th>
                            <th scope="col">Email</th>
                                 <th scope="col">Contact</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($dashboardData['unassignedTeachers'] as $teacher)
                            <tr>
                                <th scope="row">{{ $teacher->id }}</th>
                                <td>{{ $teacher->user_name }}</td>
                                <td>{{ $teacher->email }}</td>
                                <td>{{ $teacher->user_contact }}</td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
</div>

            <h1>
               Unassigned students
            </h1>
            <div style="  max-height: 200px;
  overflow-y: auto;
  border: 1px solid #ccc;"></div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col"> Name</th>
                            <th scope="col">Ic</th>
                                 <th scope="col">Age</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($dashboardData['unassignedStudents'] as $student)
                            <tr>
                                <th scope="row">{{ $student->id }}</th>
                                <td>{{ $student->student_name }}</td>
                                <td>{{ $student->student_ic }}</td>
                                <td>{{ $student->student_age }}</td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
                </div>
            @if ($classes->isNotEmpty())
               <h1>
                Classes
            </h1>
            <div style="  max-height: 200px;
  overflow-y: auto;
  border: 1px solid #ccc;">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Class Name</th>
                            <th scope="col">Class Teacher</th>
                            <th scope="col">Class Description</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            $num = 1;
                        @endphp
                        @foreach ($classes as $class)
                            <tr>
                                <th scope="row">{{ $num }}</th>
                                <td>{{ $class->class_name }}</td>
                                <td>{!! optional($class->teacher)->user_name ?? '<i>Not Set Up</i>' !!}</td>
                                <td>{{ $class->class_description }}</td>
                                <td>
                                    <a href="{{ route('viewclassroom', ['id' => $class->id]) }}"
                                        class="btn btn-sm btn-info fw-bold text-white">View</a>
                                </td>
                            </tr>
                            @php
                                $num++;
                            @endphp
                        @endforeach

                    </tbody>
                </table>
                </div>
            @else
                <div class="d-flex justify-content-center">
                    <p class="h4 fw-bold">No Class Created Yet</p>
                </div>
            @endif

        </div>
        <br>

    </div>
    </div>
    <script>

        function chartComponentTeacher(asignedCount, unasignedCount) {
            return {
                chart:null,
                labels: ['Asigned Teachers', 'Unasigned Teachers'],
                barColors: [
                    "#00aba9",
                    "#b91d47",
                ],
                data:[asignedCount, unasignedCount],
                initChart() {
                    this.chart = new Chart(this.$refs.chart, {
                        type: "bar",
                        data: {
                            labels: this.labels,
                            datasets: [{
                                backgroundColor: this.barColors,
                                data: this.data
                            }]
                        },
                        options: {
                            legend: { display: false}
                        }
                    });
                }
            }
        }

        function chartComponentStudent(asignedCount, unasignedCount ) {
            return {
                chart: null,
                labels: ['Asigned Students', 'Unasigned Students'],
                barColors: [
                    "#00aba9",
                    "#b91d47",

                ],
                data: [asignedCount, unasignedCount],
                initChart() {
                    this.chart = new Chart(this.$refs.chart, {
                        type: "doughnut",
                        data: {
                            labels: this.labels,
                            datasets: [{
                                backgroundColor: this.barColors,
                                data: this.data
                            }]
                        },

                    });
                }
            }
        }
    </script>

@endsection
