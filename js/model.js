
var App = new Vue({
	el: '#app',
	data: {
		time_in_morning: '',
		time_out_morning: '',
		time_in_afternoon: '',
		time_out_afternoon: '',
	},
	mounted() {

	},
	methods: {
		TimeInMorning: function() {
			var id = $('#employee-id').val();
			var form = { content: this.time_in_morning }
			var link = '/payroll/admin/vue/TimeInMorning.php'
			$.ajax({
				url: link,
				type: 'post',
				data: form,
				success: function(data){
					$('.timein').replaceWith('<h4 class="timein text-success">Timein Success: ID-'+ id +' </h4>');
					self.time_in_morning = ''
				}
			})
		},
		TimeOutMorning: function() {
			var id = $('#employee-id').val();
			var form = { content: this.time_out_morning }
			var link = '/payroll/admin/vue/TimeOutMorning.php'
			$.ajax({
				url: link,
				type: 'post',
				data: form,
				success: function(data){
					$('.timein').replaceWith('<h4 class="timein text-success">Timeout Success: ID-'+ id +' </h4>');
					self.time_out_morning = ''
				}
			})
		},
		TimeInAfternoon: function() {
			var id = $('#employee-id').val();
			var form = { content: this.time_in_afternoon }
			var link = '/payroll/admin/vue/TimeInAfternoon.php'
			$.ajax({
				url: link,
				type: 'post',
				data: form,
				success: function(data){
					self.time_in_afternoon = ''
					$('.timein').replaceWith('<h4 class="timein text-success">Timein Success: ID-'+ id +' </h4>');
					
				}
			})
		},
		TimeOutAfternoon: function() {
			var id = $('#employee-id').val();
			var form = { content: this.time_out_afternoon }
			var link = '/payroll/admin/vue/TimeOutAfternoon.php'
			$.ajax({
				url: link,
				type: 'post',
				data: form,
				success: function(data){
					$('.timein').replaceWith('<h4 class="timein text-success">Timeout Success: ID-'+ id +' </h4>');
					self.time_out_morning = ''
				}
			})
		},						
	}
})