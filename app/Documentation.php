<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Documentation extends Model
{
    /**
     * To get file content to return
     * @param string $file
     * @return mixed
     */
    public function get($file='documentation.md'){
        $content = File::get($this->path($file));
        return $this->replaceLinks($content);
    }
    public function path($file)
    {
        $file = ends_with($file, '.md') ? $file : $file.'.md';
        $path = base_path('docs'.DIRECTORY_SEPARATOR.$file); 
        //base_path 에서 얘기하는건 local.. so 현재프로젝트 + docs + php상수
        //원래는 'docs\'.$file

        if(!File::exists($path)){
            abort(404, 'File not founded'); //error page로 보냄
        }
        return $path;
    }
    protected function replaceLinks($contents)
    {
        return str_replace('/docs/{{version}}', '/docs', $contents);
    }
}
//파일업로드와 다운로드에서 가장 중요한게 path 
//Path와 Link는 완전 다른 말..Link는 웹 주소(상대경로), Path는 물리경로