@extends('layouts.master')

@section('content')

    <div class="container mt-3 mb-3">

        @if (session('message'))
            <div class="alert alert-info" id="success-message">
                {{ session('message') }}
            </div>
        @endif

        <div>
            <div>
                <div class="row">
                    <div class="col-md-4">
                        <h2 class="fw-bold">Total students: {{ $students->count() }}</h2>
                        <div></div>
                    </div>
                    <div class="col-md-4">
                        <h2 class="fw-bold text-end">Total unasigned students:
                            {{ $students->where('classroom_id', null)->count() }}</h2>
                    </div>
                    <div class="col-md-4">
                        <h2 class="fw-bold text-end">Total classes: {{ $classes->count() }}</h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 my-5 d-flex justify-content-center align-items-center">
                        <div style="position: relative; height:40vh; width:80vw" x-data="chartComponent(@json($students->where('classroom_id', null)->count()), @json($students->where('classroom_id', '!=', null)->count()))" x-init="initChart()">
                            <canvas x-ref="chart" id="myChart"></canvas>
                        </div>

                    </div>
                      

                    </div>
                </div>
                @if ($classes->isNotEmpty())
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
                @else
                    <div class="d-flex justify-content-center">
                        <p class="h4 fw-bold">No Class Created Yet</p>
                    </div>
                @endif

            </div>
            <br>
            <div class="d-flex justify-content-end me-4">
                <a href="/add_classroom" class="btn btn-primary fw-bold">Add Class</a>
            </div>
        </div>
    </div>
    <script>
        function lineComponent(asignedCount) {

        }
        function chartComponent(asignedCount, unasignedCount) {
            return {
                chart: null,
                labels: ['Asigned', 'Unasigned'],
                barColors: [
                       "#00aba9",
                    "#b91d47",

                ],
                data: [asignedCount, unasignedCount],
                initChart() {
                    this.chart = new Chart(this.$refs.chart, {
                        type: "pie",
                        data: {
                            labels: this.labels,
                            datasets: [{
                                backgroundColor: this.barColors,
                                data: this.data
                            }]
                        },
                        options: {
                            title: {
                                display: true,
                                text: "World Wide Wine Production"
                            }
                        }
                    });
                }
            }
        }
    </script>

@endsection
