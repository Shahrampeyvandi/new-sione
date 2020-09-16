<a href="{{$blog->url()}}" class="blog-link">
<img src="{{unserialize($blog->poster)['resize']}}" alt="{{$blog->title}}">
<h2>{{$blog->title}}</h2>
</a>