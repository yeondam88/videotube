<?php
class VideoProcessor
{
    private $connection;
    private $sizeLimit = 500000000;
    private $allowedTypes = array('mp4', 'flv', 'webm', 'mkv', 'vob', 'ogv', 'ogg', 'avi', 'wmv', 'mov', 'mpeg', 'mpg');
    private $ffmpegPath = "ffmpeg/bin/ffmpeg";

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function upload($videoUploadData)
    {
        $targetDir = "uploads/videos/";
        $videoData = $videoUploadData->videoDataArray;

        // Make unique name on each video and stored to tempFilePath
        $tempFilePath = $targetDir . uniqid() . basename($videoData['name']);

        // Remove empty spaces
        $tempFilePath = str_replace(" ", "_", $tempFilePath);

        // Process file data
        $isValidData = $this->processData($videoData, $tempFilePath);

        if (!$isValidData) {
            return false;
        }

        if (move_uploaded_file($videoData['tmp_name'], $tempFilePath)) {
            $finalFilePath = $targetDir . uniqid() . ".mp4";

            if (!$this->insertVideoData($videoUploadData, $finalFilePath)) {
                echo 'Insert query failed.';
                return false;
            }

            if (!$this->convertVideoMp4($tempFilePath, $finalFilePath)) {
                echo 'Upload Failed.';
                return false;
            }
        }
    }

    private function processData($videoData, $filePath)
    {
        // Get file extension
        $videoType = pathInfo($filePath, PATHINFO_EXTENSION);

        // Checking file size with preset limit
        if (!$this->isValidSize($videoData)) {
            echo 'File too large to upload. Can\'t be more than ' . $this->sizeLimit . ' bytes.';
            return false;
        } else if (!$this->isValidType($videoType)) {
            echo 'Invalid file type.';
            return false;
        } else if ($this->hasError($videoData)) {
            echo "Error code: " . $videoData['error'];
            return false;
        }

        return true;
    }

    private function isValidSize($data)
    {
        return $data['size'] <= $this->sizeLimit;
    }

    private function isValidType($type)
    {
        $lowercased = strtolower($type);
        return in_array($lowercased, $this->allowedTypes);
    }

    private function hasError($data)
    {
        return $data['error'] != 0;
    }

    private function insertVideoData($uploadData, $filePath)
    {
        $query = $this->connection->prepare("INSERT INTO videos(title, uploadedBy, description, privacy, category, filePath)
        VALUES(:title, :uploadedBy, :description, :privacy, :category, :filePath)");

        $query->bindParam(":title", $uploadData->title);
        $query->bindParam(":uploadedBy", $uploadData->uploadedBy);
        $query->bindParam(":description", $uploadData->description);
        $query->bindParam(":privacy", $uploadData->privacy);
        $query->bindParam(":category", $uploadData->category);
        $query->bindParam(":filePath", $filePath);

        return $query->execute();
    }

    public function convertVideoMp4($tempFilePath, $finalFilePath)
    {
        $cmd = "$this->$ffmpegPath -i $tempFilePath $finalFilePath 2>&1";

        $outputLog = array();
        exec($cmd, $outputLog, $returnCode);

        if ($returnCode != 0) {
            // Command Failed
            foreach ($outputLog as $line) {
                echo $line . '<br>';
            }
        }

        return true;
    }

    private function deleteFile($filePath)
    {
        if (!unlink($filePath)) {
            echo "Could not delete file \n";
            return false;
        }

        return true;
    }
}
