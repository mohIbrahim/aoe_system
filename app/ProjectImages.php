<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectImages extends Model
{
    protected $table = 'project_images';
    protected $fillable = ['imageable_id', 'imageable_type', 'name', 'type', 'comments'];


    /**
 	 * Block comment
 	 *    Polymorphic Relationship
 	 * @param type
 	 * @return void
	 */
    public function imageable()
    {
        return $this->morphTo();
    }

    public function receiveAndCreat($request, $fieldName, $modelClassName, $modelId, $imageType, $comments)
    {
        if($request->hasFile($fieldName))
		{
			$imageFile = $request->file($fieldName);
			$imageFile = ((!is_array($imageFile)) ?  [$imageFile] : $imageFile);
			foreach ($imageFile as $projectImage) {
				$imageNewName = $this->renameAndStoreProjectImageFile($projectImage);
				$this->createProjectImageRecord($modelClassName, $modelId, $imageNewName, $imageType, $comments);
			}
			return true;
        }
		return false;
    }
    /**
     * Delete one image
     * @param  [type] $projectImageId [description]
     * @return [type]                 [description]
     */
	public function deleteOneProjectImage($projectImageId){
		$projectImage = $this::findOrFail($projectImageId);
		$ImageName = $projectImage->name;
		$projectImage->delete();
		$this->deleteTheImageFileLocally($ImageName);
		return true;
	}
    /**
     * Delete multi images
     * @param  [array] $projectImagesIds [description]
     * @return [boolean]                   [description]
     */
	public function deleteMultiProjectImages(array $projectImagesIds)
	{
		$projectImages = $this::find($projectImagesIds);
		foreach($projectImages as $key=>$projectImage)
		{
			$ImageName = $projectImage->name;
			$projectImage->delete();
			$this->deleteTheImageFileLocally($ImageName);
		}
		return true;
	}

	private function createProjectImageRecord($modelClassName, $modelId, $imageNewName,$imageType, $comment = '')
	{
		return $this->create(['imageable_id'=>$modelId,
		 						'imageable_type'=>$modelClassName,
								'name'=>$imageNewName,
								'type'=>$imageType,
								'comments'=>$comment]);
	}

	private function updateProjectImageRecord($modelClassName, $modelId, $imageNewName, $comments)
	{
		return $this->update(['imageable_id'=>$modelId,
								'imageable_type'=>$modelClassName,
								'name'=>$imageNewName,
								'comments'=>$comments]);
	}

	private function renameAndStoreProjectImageFile($projectImage)
	{
		if($projectImage->isValid())
		{
			$image = $projectImage;
			$imageNewName = str_random(64).'.'.$image->guessExtension();
			$image->move('images/project_images', $imageNewName);
			return $imageNewName;
		}
	}

	private function deleteTheImageFileLocally($imageName)
	{
		$path = 'images/project_images/'.$imageName;
		if (file_exists($path) )
		{
            return unlink($path);
        }
		return false;
	}
}
