@extends('layouts.app')

@section('content')
		<div id="main" class="content">
			<div class="container">
				<style>
					body.custom-background {
						background: #fff
					}

					.container {
						padding: 10px 0px;
					}
				</style>
				<section class="post_content">
					<header class="post_header">
						<h1 class="post_title">更新</h1>
					</header>
					<div class="applicant__timeline">
						<ul>
{{--							--}}
{{--							<li class="warning">--}}
{{--								<div>修复首页相册底部溢出、修复移动设备标题错位，修复状态样式错位</div>--}}
{{--							</li>--}}
{{--							<li class="success">--}}
{{--								<div>新建文章样式标准、状态、相册、增加暗箱效果<br /><span class="time-ago">2016.9.21</span></div>--}}
{{--							</li>--}}
{{--							<li class="success">--}}
{{--								<div>构建层级评论系统，多层级嵌套，redesigned评论样式<br /><span class="time-ago">2016.9.20</span></div>--}}
{{--							</li>--}}
							<li>
								<div>搭建博客平台<br /><span class="time-ago">2020.04.13</span></div>
							</li>
						</ul>
					</div>
				</section>
			</div>
		</div>

@endsection
