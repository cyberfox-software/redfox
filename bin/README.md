# How-To release a framework package

## Setup

We are using the git extension `subsplit` to publish all source code changes to the remote repositories.

Follow the installation guide of the [Subsplit](https://github.com/dflydev/git-subsplit) package to install them onto your system.

## Releasing

Simple run the PowerShell script to push all changes to the designated repositories.

```powershell
./bin/release.ps1
```

## References

- [Git-Tools-Subtree-Merging](https://git-scm.com/book/en/v1/Git-Tools-Subtree-Merging)
- [a git subtrees tutorial](https://medium.com/@v/git-subtrees-a-tutorial-6ff568381844)
- [using git subtrees for repository seperation](https://makingsoftware.wordpress.com/2013/02/16/using-git-subtrees-for-repository-separation/)
