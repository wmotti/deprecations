Default filename for the specification file is ```deprecated_packages.json```, but custom specification file can be used: ```composer deprecations -f custom_deprecations.json```

Specification file example:

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
