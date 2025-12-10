@extends('layouts.master')

@section('content')
    <div style="display: flex; justify-content: center; align-items: center;">
        <canvas id="gradesChart" width="500" height="500"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('gradesChart').getContext('2d');
                const chartData = @json($chartData);

                const labels = chartData.labels;
                const data = chartData.data;

                const chart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Student Performance',
                            data: data,
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.5)', // Color for "Passed"
                                'rgba(255, 99, 132, 0.5)'  // Color for "Failed"
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',   // Border color for "Passed"
                                'rgba(255, 99, 132, 1)'    // Border color for "Failed"
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>
    </div>
    <br> 
    
    <div class="d-flex justify-content-center">
        <!-- Back button -->
        <button onclick="goBack()" class="btn btn-secondary" style="margin-right: 10px;">
            {{ __('Back') }}
        </button>
    
        <!-- Feedback button -->
        <a href="{{ route('addFeedback') }}" class="btn btn-primary" style="margin-left: 10px;">
            {{ __('Feedback') }}
        </a>
    </div>
    
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    
@endsection
