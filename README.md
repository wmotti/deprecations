## Installation

##### local
```composer require wmotti/deprecations```

##### global
```composer global require wmotti/deprecations```

## Specification file
##### filename
Default filename is ```deprecated_packages.json```, but custom specification file can be used: ```composer deprecations -f custom_deprecations.json```

##### example
```json
{
    "packages": [
        {
            "name": "<package_name>",
            "deprecations": [
                {
                    "version": "<composer version constraint>",
                    "reason": "blah blah blah",
                    "resources": [
                        "<explanatory_blog_page_url>"
                        "<github_issue_url>",
                    ]
                }
            ]
        }
    ],
    "_meta": {
        "file_format": "2"
    }
}
```
