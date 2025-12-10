@extends('layouts.master')

@section('content')
    <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 20px;">
        <canvas id="gradesChart" width="500" height="500"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('gradesChart').getContext('2d');
            const chartData = @json($chartData);
            
            const labels = chartData.labels;
            const data = chartData.data;

            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total',
                        data: data,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)', // Red color
                        borderColor: 'rgba(255, 99, 132, 1)', // Red color
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
    
    
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
