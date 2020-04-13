@extends('layouts.app')

@section('content')
		<div id="main" class="content">

			<div class="container">

				<h1 class="page-title">以&ldquo;{{$keyword}}&rdquo;为关键字</h1>

				<p class="Searchmeta">共计 {{$articles->count()}} 篇文章</p>

				<div class="location">当前位置：
					<a href="">首页</a> &raquo; 搜索结果 &raquo; {{$keyword}}
				</div>
                @foreach($articles as $article)
				<div class="posts-list js-posts">
					<div class="archive-post">
                        <br>
						<h2 class="archive-title">
					        <span>
					            <a href="/detail?id={{$article['id']}}" target="_blank">{{$article['title']}}</a>
                            </span>
					        <div class="post-time">{{$article['created_at']}}</div>
				        </h2>

{{--						<div class="post-category">--}}
{{--							<a href="" rel="category tag">Happen</a>--}}
{{--						</div>--}}

					</div>
				</div>
                @endforeach

				<div class="mt+">
					<div class="pagination js-pagination">

						<div class="js-next pagination__load"></div>

					</div>
				</div>

			</div>
		</div>

@endsection
